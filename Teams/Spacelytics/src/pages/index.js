import SideNavigation from './../components/SideNavigation';
import HamburgerMenu from './../components/HamburgerMenu';
import BgVideo from './../components/BgVideo';
import FrontPageContent from './../components/FrontPageContent';
import { signIn, signOut, useSession } from 'next-auth/client';
import { useState } from 'react';

const Home = () => {
  const [clicked, setClicked] = useState(false);
  const [session] = useSession();

  return (
    <>
      <BgVideo clicked={clicked} pause={clicked}>
        <FrontPageContent
          heading={'Spacelytics'}
          subheading={'Using ADS-B data to determine flight-positions'}
          signIn={signIn}
          session={session}
        />

        {clicked ? (
          <SideNavigation session={session} signIn={signIn} signOut={signOut} />
        ) : null}
      </BgVideo>
      <HamburgerMenu clicked={clicked} onButtonClicked={setClicked} />
    </>
  );
};
export default Home;
