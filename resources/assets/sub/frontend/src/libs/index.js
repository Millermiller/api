Array.prototype.shuffle = function () {
    let i = this.length, j, tmp;
    if (i == 0) {
        return this;
    }
    while (--i) {
        j = Math.floor(Math.random() * (i + 1));
        tmp = this[i];
        this[i] = this[j];
        this[j] = tmp;
    }
    return this;
};

Array.prototype.remove = function(value) {
    let idx = this.indexOf(value);
    if (idx != -1) {
        return this.splice(idx, 1);
    }
    return false;
};

