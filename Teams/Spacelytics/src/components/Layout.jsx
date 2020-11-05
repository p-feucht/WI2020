import Head from 'next/head';

const Layout = ({ children }) => {
  return (
    <>
      <Head>
        <title>Spacelytics</title>
      </Head>
      <main>{children}</main>
    </>
  );
};

export default Layout;
