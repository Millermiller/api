/* eslint no-extend-native: ["error", { "exceptions": ["Array"] }] */
Array.prototype.shuffle = () => {
  let i = this.length; let j; let
    tmp;
  if (i === 0) {
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

if (typeof Array.prototype.remove !== 'function') {
  Array.prototype.remove = (value) => {
    const idx = this.indexOf(value);
    if (idx !== -1) {
      return this.splice(idx, 1);
    }
    return false;
  };
}
