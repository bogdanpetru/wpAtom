var path = require("path");
var webpack = require("webpack");


module.exports = {
  cache: true,
  progress: true,
  watch: true,
  entry: {
    bundle: './src/js/app.js',
    // bootstrap: ["!bootstrap-webpack!./app/bootstrap/bootstrap.config.js", "./app/bootstrap"],
    // react: "./app/react"
  },
  output: {
    path: path.join(__dirname, "dist/js"),
    publicPath: "dist/js/",
    filename: "[name].js",
    chunkFilename: "[chunkhash].js"
  },
  module: {
    loaders: [
      { test: /\.js$/,    loader: "babel-loader" },
    ]
  },
  resolve: {
    alias: {
      // Bind version of jquery
      jquery: "jquery-2.0.3",

      // Bind version of jquery-ui
      "jquery-ui": "jquery-ui-1.10.3",

      // jquery-ui doesn't contain a index file
      // bind module to the complete module
      "jquery-ui-1.10.3$": "jquery-ui-1.10.3/ui/jquery-ui.js",
    }
  },
  plugins: [
    new webpack.ProvidePlugin({
      // Automtically detect jQuery and $ as free var in modules
      // and inject the jquery library
      // This is required by many jquery plugins
      jQuery: "jquery",
      $: "jquery"
    })
  ]
};
