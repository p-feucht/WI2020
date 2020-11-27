import { useState } from 'react';
import data from '../../../public/data/features_2000.json';
import styles from './Map.module.css';
import ReactMapGL, {
  GeolocateControl,
  FullscreenControl,
  ScaleControl,
  NavigationControl,
  Layer,
  Source,
} from 'react-map-gl';

const Mapbox_Access_Token = process.env.NEXT_PUBLIC_MapboxAccessToken;

const geolocateStyle = {
  position: 'absolute',
  bottom: 150,
  right: 0,
  margin: 10,
};
const fullscreenStyle = {
  position: 'absolute',
  bottom: 113,
  right: 0,
  margin: 10,
};
const NavigationControlStyle = {
  position: 'absolute',
  bottom: 20,
  right: 0,
  margin: 10,
};
const scaleControlStyle = {
  position: 'absolute',
  bottom: 20,
  left: 0,
  margin: 10,
};

export default function Map({ onHomeClick }) {
  const [viewport, setViewport] = useState({
    latitude: -1.9444,
    longitude: 30.0616,
    zoom: 1,
    bearing: 0,
    pitch: 0,
    width: '100vw',
    height: '100vh',
  });

  return (
    <ReactMapGL
      {...viewport}
      mapStyle='mapbox://styles/mapbox/dark-v9'
      onViewportChange={(viewport) => setViewport(viewport)}
      mapboxApiAccessToken={Mapbox_Access_Token}
    >
      <>
        <Source type='geojson' data={data}>
          <Layer
            id='point'
            type='circle'
            paint={{
              'circle-radius': 2,
              'circle-color': '#FF0000',
            }}
          />
        </Source>
        <a>
          <GeolocateControl
            style={geolocateStyle}
            positionOptions={{ enableHighAccuracy: true }}
            trackUserLocation={true}
          />
          <div style={fullscreenStyle}>
            <FullscreenControl />
          </div>
          <div style={scaleControlStyle}>
            <ScaleControl maxWidth={100} unit={'metric'} />
          </div>
          <div style={NavigationControlStyle}>
            <NavigationControl />
          </div>
        </a>
      </>
    </ReactMapGL>
  );
}
