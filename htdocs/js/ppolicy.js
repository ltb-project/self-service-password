(function() {
  var barWidth, bootstrapClasses, displayEntropyBar, displayEntropyBarMsg, ppolicyResults;

  ppolicyResults = {};

  bootstrapClasses = new Map([["Err", "bg-danger"], ["0", "bg-danger"], ["1", "bg-warning"], ["2", "bg-info"], ["3", "bg-primary"], ["4", "bg-success"]]);

  barWidth = new Map([["Err", "0"], ["0", "20"], ["1", "40"], ["2", "60"], ["3", "80"], ["4", "100"]]);

  displayEntropyBar = function(level) {
    $("#entropybar div").removeClass();
    $("#entropybar div").addClass('progress-bar');
    $("#entropybar div").width(barWidth.get(level) + '%');
    $("#entropybar div").addClass(bootstrapClasses.get(level));
    return $("#entropybar div").html(barWidth.get(level) + '%');
  };

  displayEntropyBarMsg = function(msg) {
    $("#entropybar-msg").html(msg);
    if (msg.length === 0) {
      return $("#entropybar-msg").addClass("entropyHidden");
    } else {
      return $("#entropybar-msg").removeClass("entropyHidden");
    }
  };

  setResult = function(field, result) {
    var ref, ref1;
    ppolicyResults[field] = result;
    $("#" + field).removeClass('fa-times fa-check fa-spinner fa-pulse fa-info-circle fa-question-circle text-danger text-success text-info text-secondary');
    $("#" + field).attr('role', 'status');
    switch (result) {
      case "good":
        $("#" + field).addClass('fa-check text-success');
        break;
      case "bad":
        $("#" + field).addClass('fa-times text-danger');
        $("#" + field).attr('role', 'alert');
        break;
      case "unknown":
        $("#" + field).addClass('fa-question-circle text-secondary');
        break;
      case "waiting":
        $("#" + field).addClass('fa-spinner fa-pulse text-secondary');
        break;
      case "info":
        $("#" + field).addClass('fa-info-circle text-info');
    }
    if (Object.values(ppolicyResults).every((function(_this) {
      return function(value) {
        return value === "good" || value === "info";
      };
    })(this))) {
      $('.ppolicy').removeClass('border-danger').addClass('border-success');
      return (ref = $('#newpassword').get(0)) != null ? ref.setCustomValidity('') : void 0;
    } else {
      $('.ppolicy').removeClass('border-success').addClass('border-danger');
      return (ref1 = $('#newpassword').get(0)) != null ? ref1.setCustomValidity("Insufficient quality") : void 0;
    }
  };


  // Generic feature for checkpassword action
  // check all local policy criteria one by one and display an appropriate button for each
  $(document).on('checkpassword', function(event, context) {
    var digit, evType, hasforbidden, i, len, lower, numspechar, password, report, setResult, upper;
    password = context.password;
    evType = context.evType;
    setResult = context.setResult;
    report = function(result, id) {
      if (result) {
        return setResult(id, "good");
      } else {
        return setResult(id, "bad");
      }
    };

    removePPolicyCriteria = function(criteria, feedback) {
      // first consider the criteria as fullfilled
      report( true , feedback);
      // remove criteria from the list of ppolicy checks
      delete window.policy[criteria];
      // remove the <li> tag parent to given feedback
      $( "#" + feedback ).parent().remove();
    };


    // Criteria checks
    if (window.policy.pwd_min_length > 0) {
      report(password.length >= window.policy.pwd_min_length, 'ppolicy-pwd_min_length-feedback');
    }

    if (window.policy.pwd_max_length > 0) {
      report(password.length <= window.policy.pwd_max_length, 'ppolicy-pwd_max_length-feedback');
    }

    if (window.policy.pwd_min_upper > 0) {
      upper = password.match(/[A-Z]/g);
      report(upper && upper.length >= window.policy.pwd_min_upper, 'ppolicy-pwd_min_upper-feedback');
    }

    if (window.policy.pwd_min_lower > 0) {
      lower = password.match(/[a-z]/g);
      report(lower && lower.length >= window.policy.pwd_min_lower, 'ppolicy-pwd_min_lower-feedback');
    }

    if (window.policy.pwd_min_digit > 0) {
      digit = password.match(/[0-9]/g);
      report(digit && digit.length >= window.policy.pwd_min_digit, 'ppolicy-pwd_min_digit-feedback');
    }

    if (window.policy.pwd_no_reuse && window.policy.pwd_no_reuse == true) {
      if( $( "#oldpassword" ).length )
      {
        oldpassword = $( "#oldpassword" ).val();
        report( password != oldpassword , 'ppolicy-pwd_no_reuse-feedback');
      }
      else
      {
        removePPolicyCriteria("pwd_no_reuse", 'ppolicy-pwd_no_reuse-feedback');
      }
    }

    if (window.policy.pwd_diff_login && window.policy.pwd_diff_login == true) {
      if( $( "#login" ).length )
      {
        login = $( "#login" ).val();
        report( password != login, 'ppolicy-pwd_diff_login-feedback');
      }
      else
      {
        report( true , 'ppolicy-pwd_diff_login-feedback');
      }
    }

    if (window.policy.pwd_diff_last_min_chars > 0) {
      if( $( "#oldpassword" ).length )
      {
        minDiffChars = window.policy.pwd_diff_last_min_chars;
        oldpassword = $( "#oldpassword" ).val();
        forbidden = false;
        diffCharCounter = 0;
        i = 0;
        while (i < password.length) {
          if (oldpassword.indexOf(password.charAt(i)) == -1)  {
            diffCharCounter++;
          }
          i++;
        }
        report( diffCharCounter >= minDiffChars , 'ppolicy-pwd_diff_last_min_chars-feedback');
      }
      else
      {
        removePPolicyCriteria("pwd_diff_last_min_chars", 'ppolicy-pwd_diff_last_min_chars-feedback');
      }
    }

    if (window.policy.pwd_forbidden_chars) {
      forbiddenChars = window.policy.pwd_forbidden_chars;
      forbidden = false;
      i = 0;
      while (i < password.length) {
        if (forbiddenChars.indexOf(password.charAt(i)) != -1)  {
          forbidden = true;
        }
        i++;
      }
      report( !forbidden, 'ppolicy-pwd_forbidden_chars-feedback' );
    }

    if (window.policy.pwd_min_special > 0 && window.policy.pwd_special_chars) {
      numspechar = 0;
      var re = new RegExp("["+window.policy.pwd_special_chars+"]","");
      i = 0;
      while (i < password.length) {
        if (password.charAt(i).match(re)) {
          numspechar++;
        }
        i++;
      }
      report(numspechar >= window.policy.pwd_min_special, 'ppolicy-pwd_min_special-feedback');
    }

    if ( window.policy.pwd_no_special_at_ends &&
         window.policy.pwd_no_special_at_ends == true &&
         window.policy.pwd_special_chars ) {
      var re_start = new RegExp("^["+window.policy.pwd_special_chars+"]","");
      var re_end = new RegExp("["+window.policy.pwd_special_chars+"]$","");
      report( ( !password.match(re_start) && !password.match(re_end) ) , 'ppolicy-pwd_no_special_at_ends-feedback');
    }

    if ( window.policy.pwd_complexity) {
      complexity = 0;
      if (window.policy.pwd_special_chars) {
        var re = new RegExp("["+window.policy.pwd_special_chars+"]","");
        if( password.match(re) ){
          complexity++;
        }
      }
      if( password.match(/[A-Z]/g) ){
        complexity++;
      }
      if( password.match(/[a-z]/g) ){
        complexity++;
      }
      if( password.match(/[0-9]/g) ){
        complexity++;
      }
      report( complexity >= window.policy.pwd_complexity, 'ppolicy-pwd_complexity-feedback');
    }


    if ( window.policy.use_pwnedpasswords) {
      setResult('ppolicy-use_pwnedpasswords-feedback', "info");
    }

  });



  // Specific feature for checkentropy action
  $(document).on('checkpassword', function(event, context) {
    var entropyrequired, entropyrequiredlevel, evType, newpasswordVal, password, setResult;
    password = context.password;
    evType = context.evType;
    setResult = context.setResult;
    if ($('#ppolicy-checkentropy-feedback').length > 0) {
      newpasswordVal = $("#newpassword").val();
      entropyrequired = $("span[trspan='checkentropyLabel']").attr("data-checkentropy_required");
      entropyrequiredlevel = $("span[trspan='checkentropyLabel']").attr("data-checkentropy_required_level");
      if (newpasswordVal.length === 0) {
        displayEntropyBar("Err");
        displayEntropyBarMsg("");
        setResult('ppolicy-checkentropy-feedback', "unknown");
      }
      if (newpasswordVal.length > 0) {
        return $.ajax({
          dataType: "json",
          url: "/?action=checkentropy&password=" + btoa(newpasswordVal),
          context: document.body,
          success: function(data) {
            var level, msg;
            level = data.level;
            msg = data.message;
            if (level !== void 0) {
              if (parseInt(level) >= 0 && parseInt(level) <= 4) {
                displayEntropyBar(level);
                displayEntropyBarMsg(msg);
                if (entropyrequired === "1" && entropyrequiredlevel.length > 0) {
                  if (parseInt(level) >= parseInt(entropyrequiredlevel)) {
                    setResult('ppolicy-checkentropy-feedback', "good");
                  } else {
                    setResult('ppolicy-checkentropy-feedback', "bad");
                  }
                }
                if (entropyrequired !== "1") {
                  return setResult('ppolicy-checkentropy-feedback', "good");
                }
              } else if (parseInt(level) === -1) {
                displayEntropyBar(level);
                displayEntropyBarMsg(msg);
                return setResult('ppolicy-checkentropy-feedback', "bad");
              } else {
                displayEntropyBar(level);
                displayEntropyBarMsg(msg);
                return setResult('ppolicy-checkentropy-feedback', "unknown");
              }
            }
          },
          error: function(j, status, err) {
            var res;
            if (err) {
              console.log('checkentropy: frontend error: ', err);
            }
            if (j) {
              res = JSON.parse(j.responseText);
            }
            if (res && res.error) {
              return console.log('checkentropy: returned error: ', res);
            }
          }
        });
      }
    }
  });



  checkpassword = function(password, evType) {
    var e, info;
    e = jQuery.Event("checkpassword");
    info = {
      password: password,
      evType: evType,
      setResult: setResult
    };
    return $(document).trigger(e, info);
  };
  if ( (window.policy != null) && $('#newpassword').length) {
    checkpassword('');
    $('#newpassword').keyup(function(e) {
      checkpassword(e.target.value);
    });
    $('#newpassword').focusout(function(e) {
      checkpassword(e.target.value, "focusout");
    });
  }

}).call(this);
