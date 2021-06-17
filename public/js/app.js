HabboHome = {
    initialize() {
        this.initFunctions();
        this.formSpoofing();
    },

    initFunctions() {
        $(document).tooltip({
            selector: '[data-toggle="tooltip"]',
            html: true,
            boundary: 'window'
        });

        iziToast.settings({
            transitionIn: "flipInX",
            icon: "Fontawesome",
            transitionOut: "flipOutX",
            theme: 'dark',
            displayMode: 'replace',
            position: "topCenter",
            timeout: 3e3
        });
    },

    formSpoofing() {
        $("form:not(.active)").removeClass("active").addClass("active").on("submit", function(t) {
            t.preventDefault();

            let data = new FormData($(this)[0]),
                sendButton = $(this).find('button[type="submit"'),
                defaultButtonText = sendButton.text(),
                url = $(this).attr('action');

            $.ajax({
                url,
                type: "POST",
                dataType: "JSON",
                data,
                processData: false,
                contentType: false,
                beforeSend: () => {
                    sendButton.attr("disabled", true).html('<img src="/images/progress.gif" alt="Wait..." />');
                },
                success: (data) => {
                    setTimeout(() => {
                        sendButton.attr("disabled", false).html(defaultButtonText);
                    }, 1500);

                    if(data.status === "error") {
                        iziToast.show({
                            title: data.title,
                            image: '/images/error.gif',
                            imageWidth: 40,
                            progressBarColor: 'rgba(255, 94, 87,1.0)',
                            message: data.data
                        });
                    } else {
                        iziToast.show({
                            title: data.title,
                            image: '/images/success.gif',
                            imageWidth: 56,
                            progressBarColor: 'rgba(68, 189, 50, 1.0)',
                            message: data.data
                        });

                        if(data.redirect) {
                            setTimeout(_ => window.location = data.redirect, 1500);
                        }
                    }
                },
                error: _ => {
                    setTimeout(() => {
                        sendButton.attr("disabled", false).html(defaultButtonText);
                    }, 1500);

                    iziToast.show({
                        title: "Oops",
                        image: '/images/error.gif',
                        imageWidth: 40,
                        progressBarColor: 'rgba(255, 94, 87,1.0)',
                        message: "Error!"
                    });
                }
            })
        })
    }
}

$(function() {
    HabboHome.initialize();
});