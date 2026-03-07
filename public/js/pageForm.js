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
    }

    submit() {
        const formData = new FormData(this.elmtForm);
        const url = this.getActionForm();
        fetch(url+'@submit', {
            method: 'post',
            body: formData
        })
        .then(res => {
            console.log({'res': res})
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
