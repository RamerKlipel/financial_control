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
        const url = this.elmtForm.getAttribute('action');
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
}

const pageform = new pageForm();
