import Head from 'next/head';
import { useRef } from 'react';
import Link from 'next/Link';
import Layout from './../components/Layout';
const Home = () => {
  const videoRef = useRef();
  const setPlayBackSpeed = (e) => {
    videoRef.current.playbackRate = 0.3;
    console.log(videoRef.current.playbackRate);
  };
  return (
    <>
      <Head>
        <title>Frontpage</title>
        {/* Todo: Add description */}
      </Head>
      <Layout>
        <section className='showcase'>
          <div className='video-container'>
            <video
              ref={videoRef}
              onPlay={setPlayBackSpeed}
              src={require('./../../public/videos/Earth_R.mp4')}
              type='video/mp4'
              muted
              autoPlay
              loop
            />
          </div>
          <div className='content'>
            <h1 className='font-mono text-6xl'>Spacelytics </h1>
            <h3 className='font-mono text-lg'>
              Using ADS-B data to determine flight-positions in real-time{' '}
            </h3>
            <Link href='/map'>
              <a className='btn'>Sign In</a>
            </Link>
          </div>
        </section>
      </Layout>
    </>
  );
};
export default Home;
