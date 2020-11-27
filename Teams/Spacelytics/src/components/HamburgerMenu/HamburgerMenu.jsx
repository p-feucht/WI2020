import React, { useState } from 'react';
import styles from './HamburgerMenu.module.css';
import classNames from 'classnames/bind';

const cx = classNames.bind(styles);

const HamburgerMenu = ({ clicked, onButtonClicked }) => {
  const top = clicked ? 'top' : '';
  const middle = clicked ? 'middle' : '';
  const bottom = clicked ? 'bottom' : '';

  return (
    <div
      className={styles.hamburgerMenu}
      onClick={() =>
        !clicked ? onButtonClicked(true) : onButtonClicked(false)
      }
    >
      <div className={styles.bar} id={cx({ [`${top}`]: true })} />
      <div className={styles.bar} id={cx({ [`${middle}`]: true })} />
      <div className={styles.bar} id={cx({ [`${bottom}`]: true })} />
    </div>
  );
};

export default HamburgerMenu;
