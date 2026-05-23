export class maskhelper {
    constructor() {
        this.setBinds();
    }

    setBinds() {
        document.querySelectorAll('[data-mask]')?.forEach(this.handleMaskType);
    }

    handleMaskType(elmt) {
        const maskType = elmt.dataset.mask;
        switch (maskType) {
            case 'coin-decimal-152':
                elmt.addEventListener('input', (e) => {
                    let val = elmt.value.match(/\d+/g)?.join('');

                    if (!val) {
                        return;
                    }

                    const vlDecimal = val.length > 0 ? val.slice(-2).slice(0,2) : '00';
                    const value = val.length > 3 ? BigInt(val.slice(0, -2).slice(0,15)).toLocaleString('pt-BR') : '0';

                    elmt.value = value+","+vlDecimal;
                })
                break;
            case 'BRdate':
                elmt.addEventListener("input", (e) => {
                    const val = elmt.value.match(/\d+/g)?.join('');

                    if (!val) {
                        return;
                    }

                    const valSplit = val.split('');
                    let date = "";
                    for (let i = 0; i < 8; i++) {
                        if (valSplit[i] != undefined) {
                            if ([2, 4].includes(i)) {
                                date += "/";
                            }
                            date += valSplit[i];
                        }
                    }
                    elmt.value = date;
                })
        }
    }
}

new maskhelper();
