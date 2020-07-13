var Notify = function () {
    var self = this;
    var title,
        message,
        status,
        form,
        timeout;

    this.setTitle = function(title) {
        self.title = "<b>"+title+"</b> <br>";
        return this;
    };

    this.setMessage = function(message) {
        self.message = message;
        self.show();
        return this;
    };

    this.setStatus = function(status) {
        self.status = status;
        return this;
    };

    this.setForm = function(form) {
        self.form = form;
        return this;
    };

    this.show = function () {

        $.fancybox.open({
            src: '#alert_modal',

        });

        $('#alert_modal').removeClass('alert-success')
                     .removeClass('alert-danger')
                     .addClass('alert-' + self.status)
                     .find('p')
                     .html(self.message);


        clearTimeout(self.timeout);
        self.timeout = setTimeout(function() {
            $.fancybox.close({
                src  : '#alert_modal'
            });
        }, 127000);
    };
}
var Notify = new Notify();