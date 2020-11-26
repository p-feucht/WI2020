import React from 'react';
import styles from './SideNavigation.module.css';
import classNames from 'classnames/bind';
import Link from 'next/link';

const cx = classNames.bind(styles);

const SideNavigation = ({ session, signIn, signOut }) => {
  const status = session ? '' : 'inactive';
  const mapLink = session ? '' : 'mapLink';
  return (
    <div id={styles.container}>
      <div id={styles.head}>
        <span id={styles.heading}>Spacelytics</span>
      </div>
      <nav>
        <div className={styles.listItems}>
          <svg
            width='24'
            fill='white'
            height='24'
            xmlns='http://www.w3.org/2000/svg'
            fillRule='evenodd'
            clipRule='evenodd'
          >
            <path d='M22 11.414v12.586h-20v-12.586l-1.293 1.293-.707-.707 12-12 12 12-.707.707-1.293-1.293zm-6 11.586h5v-12.586l-9-9-9 9v12.586h5v-9h8v9zm-1-7.889h-6v7.778h6v-7.778z' />
          </svg>
          <Link href='/' passHref>
            <a title='Home' className={styles.links}>
              Home
            </a>
          </Link>
        </div>
        <div
          id={cx({ [`link--${status}`]: true })}
          className={styles.listItems}
          onClick={() => (session ? '' : alert('Please Sign In First  '))}
        >
          <svg
            fill='white'
            xmlns='http://www.w3.org/2000/svg'
            width='24'
            height='24'
            viewBox='0 0 24 24'
          >
            <path d='M12 0c-3.148 0-6 2.553-6 5.702 0 4.682 4.783 5.177 6 12.298 1.217-7.121 6-7.616 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm12 16l-6.707-2.427-5.293 2.427-5.581-2.427-6.419 2.427 4-9 3.96-1.584c.38.516.741 1.08 1.061 1.729l-3.523 1.41-1.725 3.88 2.672-1.01 1.506-2.687-.635 3.044 4.189 1.789.495-2.021.465 2.024 4.15-1.89-.618-3.033 1.572 2.896 2.732.989-1.739-3.978-3.581-1.415c.319-.65.681-1.215 1.062-1.731l4.021 1.588 3.936 9z' />
          </svg>
          <Link href={'/map'} passHref>
            <a className={styles.links} id={cx({ [`${mapLink}`]: true })}>
              Map
            </a>
          </Link>
        </div>
        <div id={styles.line}></div>

        <div className={styles.listItemsSignIn}>
          <svg
            fill='white'
            xmlns='http://www.w3.org/2000/svg'
            width='24'
            height='24'
            viewBox='0 0 24 24'
          >
            <path d='M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z' />
          </svg>
          <button
            id={styles.signin}
            className={styles.links}
            onClick={session ? signOut : signIn}
          >
            {session ? 'Sign Out' : 'Sign In'}
          </button>
        </div>
      </nav>
    </div>
  );
};

export default SideNavigation;
