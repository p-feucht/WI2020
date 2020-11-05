import { useState } from "react";
import ReactMapGL, { Marker } from "react-map-gl";
import EventForm from "../eventForm/EventForm.jsx";
import Pin from "../pin/Pin.jsx";

export default function Map() {
  const geoapifyApiAccessToken = "34e2d183388c4c1190bfe5a6307ee61e";
  const mapboxApiAccessToken =
    "pk.eyJ1IjoibTN0cm9pZCIsImEiOiJja2d4bTcwZmwwOTlxMnRwZHBhc3JpM3dyIn0.qEJVJ9-lOn1EuoxEjlM_nA";
  const [viewport, setViewport] = useState({
    latitude: 53.130442450000004,
    longitude: 10.475954510368993,
    width: "100vw",
    height: "100vh",
    zoom: 10,
  });

  function setEvent(name, description, street, number, city, state, zip) {
    const queryStreet = street.split(" ").join("%20");
    const queryString = `https://nominatim.openstreetmap.org/search?street=${number}%20${queryStreet}&city=${city}&country=${state}&postalcode=${zip}&format=json`;
    geocode(queryString);
  }

  function geocode(queryString) {
    fetch(queryString)
      .then((res) => {
        return res.json();
      })
      .then((data) => {
        const lat = parseFloat(data[0].lat);
        const lon = parseFloat(data[0].lon);
        setViewport({
          latitude: lat,
          longitude: lon,
          width: "100vw",
          height: "100vh",
          zoom: 15,
        });
      }),
      (error) => {
        console.log(error);
      };
  }

  return (
    <div className="relative">
      <ReactMapGL
        {...viewport}
        mapboxApiAccessToken={mapboxApiAccessToken}
        mapStyle="mapbox://styles/m3troid/ckgxrmim3317c19lhebw5kr4u"
        onViewportChange={(viewport) => {
          setViewport(viewport);
        }}
      >
        <Marker
          key={1}
          latitude={53.130442450000004}
          longitude={10.475954510368993}
          offsetTop={-70}
          offsetLeft={-70 / 2}
        >
          <Pin />
        </Marker>
      </ReactMapGL>
      <button
        className="absolute bottom-0 right-0 block w-20 h-20 m-20 bg-gray-800 rounded-full"
        onClick={() => {
          document
            .getElementById("eventForm-container")
            .classList.remove("hidden");
        }}
      >
        <svg
          width="100%"
          height="100%"
          version="1.1"
          viewBox="0 0 500.00001 500.00001"
          xmlns="http://www.w3.org/2000/svg"
        >
          <g transform="translate(0 -552.36)">
            <path
              transform="translate(0 552.36)"
              d="m250 19.068c-127.54 3.03e-4 -230.93 103.39-230.93 230.93 3.04e-4 127.54 103.39 230.93 230.93 230.93 127.54-3e-4 230.93-103.39 230.93-230.93-3e-4 -127.54-103.39-230.93-230.93-230.93zm-13.734 94.056h27.468c5.0488 0 9.1218 4.0644 9.1133 9.1133v104.92h104.92c5.0488 0 9.1133 4.0644 9.1133 9.1133v27.468c0 5.0488-4.0644 9.1133-9.1133 9.1133h-104.92v104.92c0 5.0488-4.0644 9.1133-9.1133 9.1133h-27.468c-5.0488 0-9.1218-4.0644-9.1133-9.1133v-104.92h-104.92c-5.0488 0-9.1133-4.0644-9.1133-9.1133v-27.468c0-5.0488 4.0644-9.1133 9.1133-9.1133h104.92v-104.92c0-5.0488 4.0644-9.1133 9.1133-9.1133z"
              fill="#ff5252"
            />
          </g>
        </svg>
      </button>
      <div
        className="absolute inset-0 hidden rounded-lg shadow-xl"
        id="eventForm-container"
      >
        <EventForm
          setEvent={setEvent}
          geocode={geocode}
          setViewport={setViewport}
        />
      </div>
    </div>
  );
}
