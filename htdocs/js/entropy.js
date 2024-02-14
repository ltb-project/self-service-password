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
      $('.help').removeClass('border-danger').addClass('border-success');
      return (ref = $('#newpassword').get(0)) != null ? ref.setCustomValidity('') : void 0;
    } else {
      $('.help').removeClass('border-success').addClass('border-danger');
      return (ref1 = $('#newpassword').get(0)) != null ? ref1.setCustomValidity("Insufficient quality") : void 0;
    }
  };

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
  if ( $('#ppolicy-checkentropy-feedback').length && $('#newpassword').length) {
    checkpassword('');
    $('#newpassword').keyup(function(e) {
      checkpassword(e.target.value);
    });
    $('#newpassword').focusout(function(e) {
      checkpassword(e.target.value, "focusout");
    });
  }

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
          url: "/checkentropy.php?password=" + btoa(newpasswordVal),
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

}).call(this);
