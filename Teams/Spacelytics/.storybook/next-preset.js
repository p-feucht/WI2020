const path = require('path');

module.exports = {
  webpackFinal: async (baseConfig, options) => {
    // Modify or replace config. Mutating the original reference object can cause unexpected bugs.
    const { module = {} } = baseConfig;

    const newConfig = {
      ...baseConfig,
      module: {
        ...module,
        rules: [...(module.rules || [])],
      },
    };

    //
    // CSS Modules
    // Many thanks to https://github.com/storybookjs/storybook/issues/6055#issuecomment-521046352
    //

    // First we prevent webpack from using Storybook CSS rules to process CSS modules
    newConfig.module.rules.find(
      (rule) => rule.test.toString() === '/\\.css$/'
    ).exclude = /\.module\.css$/;

    // Then we tell webpack what to do with CSS modules
    newConfig.module.rules.push({
      test: /\.module\.css$/,
      include: [
        path.resolve(__dirname, '../src/components'),
        path.resolve(__dirname, '../src/styles/global.css'),
      ],
      use: [
        'style-loader',
        {
          loader: 'css-loader',
          options: {
            sourceMap: true,
            importLoaders: 1,
            modules: {
              compileType: 'module',
              mode: 'local',
              auto: true,
              localIdentName: '[local]--[hash:base64:5]',
            },
          },
        },
      ],
    });

    return newConfig;
  },
};
