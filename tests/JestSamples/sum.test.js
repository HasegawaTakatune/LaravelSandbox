const sum = require('./sum');

// npm jest
it('関数sumに1と2を渡すと3が返ってくる', () => {
    const result = sum(1, 2)
    expect(result).toBe(3)
  })