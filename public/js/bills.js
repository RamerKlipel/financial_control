import helper from '../utilities/helper.js';
class bills {
    constructor() {
        this.onChange();
        this.setBinds();
    }

    setBinds() {
        document.getElementById('FLINSTALLMENT')?.addEventListener('change', (e) => {
            this.toggleFlInstallment();
        })

        document.getElementById('TPPAYMENT')?.addEventListener('change', (e) => {
            this.toggleTypePayment();
        })

        document.getElementById('FLPAID')?.addEventListener('change', (e) => {
            this.toggleDaPayment();
        })
    }

    toggleDaPayment() {
        const elmtPaid = document.getElementById('FLPAID');
        const elmtDaPayment = document.getElementById('divDAPAYMENT');
        helper.toggleAnimation(elmtDaPayment, elmtPaid?.value == 'S');
    }

    toggleTypePayment() {
        const elmtTypePayment = document.getElementById('TPPAYMENT');
        const elmtCreditCard = document.getElementById('divIDCREDITCARD');
        helper.toggleAnimation(elmtCreditCard, ['CD','CC'].includes(elmtTypePayment?.value));
    }

    toggleFlInstallment() {
        const elmtFlInstallment = document.getElementById('FLINSTALLMENT');
        const elmtNrInstallment = document.getElementById('divNRINSTALLMENT');
        helper.toggleAnimation(elmtNrInstallment, elmtFlInstallment?.value == 'S');
    }

    onChange() {
        this.toggleDaPayment();
        this.toggleTypePayment();
        this.toggleFlInstallment();
    }
}

new bills();
