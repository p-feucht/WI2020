import React from 'react';
import styles from './FrontPageContent.module.css';
import Link from 'next/link';
export const FrontPageContent = ({ session, heading, subheading, signIn }) => {
  return (
    <div id={styles.content}>
      <h1 id={styles.heading}>{heading}</h1>
      <h3 id={styles.subheading}>{subheading}</h3>

      {session ? (
        <Link href='/map'>
          <a className={styles.primAction} href=''>
            Go to Map
          </a>
        </Link>
      ) : (
        <button
          id={styles.goMap}
          className={styles.primAction}
          onClick={signIn}
        >
          Sign In
        </button>
      )}
    </div>
  );
};
export default FrontPageContent;
