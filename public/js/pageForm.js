import mountModalAlert from "../utilities/mountmodalalert.js";
class pageForm {
    constructor() {
        this.elmtForm = document.querySelector('form');
        this.setBinds();
    }

    setBinds() {
        document.addEventListener('submit', (e) => {
            e.preventDefault();
            this.submit();
        });

        document.querySelectorAll('.btn-action[data-action]').forEach(elmt => {
            elmt.addEventListener('click', (e) => {
                const action = elmt.getAttribute('data-action');
                const href = elmt.getAttribute('href');
                if (action == "d") {
                    e.preventDefault();

                    mountModalAlert({
                        'width': '50%',
                        'title': 'Attention',
                        'body': 'you sure you want delete this?',
                        'icon': 'warning',
                        onConfirm:() => {
                            fetch(href, {
                                method: 'get'
                            })
                            .then(res => {
                                if (!res.ok) {
                                    throw new Error('server error ' + res.status);
                                }
                                mountModalAlert({
                                    'body': 'the item was deleted successfully!',
                                    'icon': 'success',
                                    'showCancelBtn' : false,
                                    'confirmBtnText': 'Ok',
                                    onConfirm: () => {
                                        window.location.reload();
                                    }
                                })
                            })
                            .catch(res => {
                                console.log(res);
                                mountModalAlert({
                                    'body': res,
                                    'icon': 'error',
                                    'showCancelBtn' : false,
                                    'confirmBtnText': 'Ok'
                                })
                            })
                        }
                    })
                }
            });
        });
        // .forEach((btn) => {
        //     btn.addEventListener('click', (a) => {
        //         a.preventDefault();
        //         switch (action) {
        //             case d
        //         }
        //     })
        // });
    }

    submit() {
        const formData = new FormData(this.elmtForm);
        const url = this.getActionForm();
        fetch(url+'@submit', {
            method: 'post',
            body: formData
        })
        .then(res => {
            this.preventDefault();
            window.location.href = url+'?complete=true';
        })
        .catch(err => {
            if (err) console.log(err);
        })
    }

    getActionForm() {
        if (this.elmtForm) {
            return this.elmtForm.getAttribute('action');
        } else {
            return document.querySelector('form').getAttribute('action');
        }
    }
}

const pageform = new pageForm();
