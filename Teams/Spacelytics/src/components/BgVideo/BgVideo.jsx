import classNames from 'classnames/bind';
import styles from './BgVideo.module.css';
import PropTypes from 'prop-types';

const cx = classNames.bind(styles);
/**
 * Fullscreen background video that is fully responsive
 */
const BgVideo = ({
  videoLocation,
  loop,
  controls,
  autoPlay,
  children,
  clicked,
}) => {
  const showcase = clicked ? '--indented' : '';
  const videoContainer = clicked ? '--indented' : '';
  return (
    <section className={cx({ [`showcase${showcase}`]: true })}>
      <div className={cx({ [`videoContainer${videoContainer}`]: true })}>
        <video
          preload='auto'
          src={videoLocation}
          type='video/mp4'
          muted
          loop={loop}
          controls={controls}
          autoPlay={autoPlay}
        />
      </div>
      {children}
    </section>
  );
};

export default BgVideo;

BgVideo.propTypes = {
  /**
   * Where is your video located?
   */
  videoLocation: PropTypes.string.isRequired,
  /**
   * Should the video loop ?
   */
  loop: PropTypes.bool,
  /**
   * Should video controls be displayed ?
   */
  controls: PropTypes.bool,
  /**
   * Should the video automatically start to play  ?
   */
  autoPlay: PropTypes.bool,
};

BgVideo.defaultProps = {
  videoLocation:
    'https://res.cloudinary.com/diz3ottxo/video/upload/v1606299408/minimal-globe_uardxq.mp4',
  loop: true,
  controls: true,
  autoPlay: true,
};
