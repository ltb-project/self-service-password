/*
  jquery-selectunique.js v0.1.0

  Given a group of select fields with the same options, SelectUnique will remove an option from the
  other select fields when it's selected, and put it back when it's changed.

  Home: http://github.com/sshaw/jquery-selectunique
  License (MIT): http://www.opensource.org/licenses/mit-license.php

  Copyright (c) 2013 Skye Shaw
*/

(function($) {
    var NS = 'selectunique';
    var KEY_SELECTED = NS + '-selected';

    var SelectUnique = function(q, options) {
  var self = this;

  self.q = q.find('option').parent('select');  // We need a set containing the select elements
  self.options = $.extend({}, options);
  self.optionIndex = {};

  self.q.on('change.' + NS, function() {
      self._selectChanged($(this));
  });

  $(self._uniqueOptions(self.q.find('option'))).each(function() {
      self.optionIndex[self._optionId(this)] = this.index;
  });

  self.q.has(':selected').each(function() {
      self._optionSelected($(this));
  });
    };

    SelectUnique.prototype = {
  constructor: SelectUnique,

  _selectChanged: function(select) {
      var self = this, prevOption = select.data(KEY_SELECTED);

      if(prevOption) {
    self.q.not(select).each(function() {
        var thisSelect = $(this);
        thisSelect.append(self._cloneOption(prevOption));
        self._sortOptions(thisSelect);
    });
      }

      self._optionSelected(select);
  },

  _optionSelected: function(select) {
      var self = this, selOption = select.find(':selected');

      if(self._ignoreOption(selOption)) {
    select.data(KEY_SELECTED, null);
      }
      else {
    select.data(KEY_SELECTED, selOption);
    self.q.not(select).each(function() {
        var thisSelect = $(this);
        thisSelect.find('option').each(function() {
      var thisOption = $(this);

      // Ignore val(), we only care about what the user sees. This allows for cases
      // where the text is the same but the value is dependent on the select it's in.
      if(selOption.text() == thisOption.text()) {
          thisOption.remove();
          return;
      }
        });
    });
      }
  },

  _ignoreOption: function(option) {
      return $.trim(option.val()) == '' || ($.isFunction(this.options.ignoreOption) && this.options.ignoreOption(option));
  },

  _cloneOption: function(option) {
      // We must set selected to false everytime because this will be true:
      // (cache[x] = original.clone(true).prop('selected', false)).clone(true).prop('selected')
      return option.clone(true).prop('selected', false);
  },

  _sortOptions: function(select) {
      var self = this, options = select.find('option'), val = select.val();
      options.sort(function(a,b) {
    return self.optionIndex[self._optionId(a)] - self.optionIndex[self._optionId(b)];
      });

      select.html(options);
      select.val(val);
  },

  _optionId: function(option) {
      return [option.value, option.text].join('-');
  },

  _uniqueOptions: function(options) {
      var self = this, unique = [], seen = {};

      options.each(function() {
    var key = self._optionId(this);
    if(!seen[key] && !self._ignoreOption($(this))) {
        seen[key] = true;
        unique.push(this);
    }
      });

      return unique;
  },

  _removeHandlers: function() {
      this.q.off('.'+NS);
  },

  refresh: function() {
      var self = this;

  },

  selected: function() {
      var selected = this._uniqueOptions(this.q.find(':selected'));
      return $.map(selected, function(e) {
    return e.cloneNode(true);
      });
  },

  remaining: function() {
      var remaining = this._uniqueOptions(this.q.find('option:not(:selected)'));
      return $.map(remaining, function(e) {
    return e.cloneNode(true);
      });

  }
    };

    $.fn.selectunique = function(options) {
  if(this.has('select,option').length) {
      var uniq = this.data(NS);
      if(!uniq)
    this.data(NS, uniq = new SelectUnique(this, options));

      if(typeof options == 'string') {
    if(options == 'refresh') {
        uniq._removeHandlers();
        this.data(NS, uniq = new SelectUnique(this));
    }
    else {
        if(!uniq[options])
      $.error("selectunique: no such method '" + options + "'");

        return uniq[options]();
    }
      }
  }

  return this;
    };
})(window.jQuery);
