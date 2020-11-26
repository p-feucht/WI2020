import './../styles/global.css';
import { Provider } from 'next-auth/client';
import Head from 'next/head';

function MyApp({ Component, pageProps }) {
  return (
    <Provider session={pageProps.session}>
      <Head>
        <title>Spacelytics</title>
        <link
          href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css'
          rel='stylesheet'
        />
        <link
          rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
        />
      </Head>
      <Component {...pageProps} />
    </Provider>
  );
}

export default MyApp;
