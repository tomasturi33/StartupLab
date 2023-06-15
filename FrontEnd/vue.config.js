module.exports = {
  publicPath: '/unlpotencia/',
  transpileDependencies: [
    'vuetify'
  ],
  chainWebpack: config => {
    config
      .plugin('html')
      .tap(args => {
        args[0].title = 'UNLPotencia';	// Replace your title here
        return args;
      });
  }
}