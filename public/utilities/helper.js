export class helper {
    static toggleAnimation(elmt, fl) {
        elmt?.classList?.toggle('show', fl);
        elmt?.classList?.toggle('hide', !fl);
    }
}
