(function() {
      $('.wizard').wizard({
        step: '> .nav > li > a',
        templates: {
          buttons: function() {
            var options = this.options;
            return '<div class="clearfix">' +
             // '<button class="btn btn-default" data-target="#' + this.id + '" data-wizard="back">' + options.buttonLabels.back + '</button>' +
              '<button id="btn-siguiente" class="btn btn-success pull-right" data-target="#' + this.id + '" data-wizard="next">' + options.buttonLabels.next + '</button>' +
              //'<button class="btn btn-primary pull-right" data-target="#' + this.id + '" data-wizard="finish">' + options.buttonLabels.finish + '</button>' +
              '</div>';
          }
        },
        onBeforeShow: function(step) {
          step.$element.tab('show');
        },
        onFinish: function() {
          alert('finish');
        }
      });
    })();