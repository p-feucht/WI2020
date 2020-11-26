import 'mapbox-gl/dist/mapbox-gl.css';
import { useState } from 'react';
import { useSession, signIn, signOut } from 'next-auth/client';
import Map from '../components/Map/Map.jsx';
import SideNavigation from './../components/SideNavigation';
import HamburgerMenu from './../components/HamburgerMenu';
import { useRouter } from 'next/router';
import { useEffect } from 'react';

const MapPage = () => {
  const router = useRouter();
  const [clicked, setClicked] = useState(false);
  const [session] = useSession();
  useEffect(() => {
    if (!session) {
      router.push('/');
    }
  }, [session]);

  const mode = clicked ? 'container--indented' : '';
  console.log(mode);
  return (
    <>
      <div className={mode}>
        <Map className='Map' />
        {clicked ? (
          <SideNavigation session={session} signIn={signIn} signOut={signOut} />
        ) : null}
      </div>
      <HamburgerMenu clicked={clicked} onButtonClicked={setClicked} />
    </>
  );
};
export default MapPage;
