const BgVideo = () => {
  return (
    <section className='showcase'>
      <div className='video-container'>
        <video
          ref={videoRef}
          onPlay={setPlayBackSpeed}
          src={require('/videos/Earth_R.mp4')}
          type='video/mp4'
          muted
          autoPlay
          loop
        />
      </div>
      <div className='content'>
        <h1>Spacelytics </h1>
        <h3>Using ADS-B data to determine flight-positions in real-time </h3>
        <Link href='/map'>
          <a className='btn'>Sign In</a>
        </Link>
      </div>
    </section>
  );
};

export default BgVideo;
