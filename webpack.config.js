const path = require('path');

module.exports = {
  mode: "development",
  entry: '/public/src/main.js',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'public/dist/'),
  }
};
