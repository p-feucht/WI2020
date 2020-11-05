import { useState } from "react";
export default function EventForm(props) {
  return (
    <div className="relative w-1/3 h-auto p-10 mx-auto my-20 bg-black bg-opacity-75 rounded-3xl">
      <button
        className="absolute top-0 right-0 block w-8 h-auto m-5"
        onClick={() =>
          document.getElementById("eventForm-container").classList.add("hidden")
        }
      >
        <svg
          width="100%"
          height="100%"
          version="1.1"
          viewBox="0 0 50 50"
          xmlns="http://www.w3.org/2000/svg"
        >
          <g transform="translate(0 -1002.4)">
            <g
              transform="matrix(1.0898 0 0 1.0898 -2.2448 -90.742)"
              fill="#bababa"
            >
              <rect
                transform="matrix(.70711 -.70711 .70711 .70711 0 0)"
                x="-711.79"
                y="720.53"
                width="7.9755"
                height="45.245"
                ry="2.131"
              />
              <rect
                transform="matrix(.70711 .70711 -.70711 .70711 0 0)"
                x="739.17"
                y="685.18"
                width="7.9755"
                height="45.245"
                ry="2.131"
              />
            </g>
          </g>
        </svg>
      </button>
      <div className="flex flex-wrap mb-6 -mx-3">
        <div className="w-full px-3 mb-6 md:w-1/2 md:mb-0">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-event"
          >
            Event name
          </label>
          <input
            className="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-event"
            type="text"
            placeholder="name for an event"
          />
        </div>
      </div>
      <div className="flex flex-wrap mb-6 -mx-3">
        <div className="w-full px-3">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-description"
          >
            Description
          </label>
          <textarea
            className="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-description"
            placeholder="description for event"
          />
        </div>
      </div>
      <div className="flex flex-wrap mb-6 -mx-3">
        <div className="w-full px-3 mb-6 md:w-1/2 md:mb-0">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-street"
          >
            Street
          </label>
          <input
            className="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-street"
            type="text"
            placeholder="street name"
          />
        </div>
        <div className="w-full px-3 mb-6 md:w-1/2 md:mb-0">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-number"
          >
            number
          </label>
          <input
            className="block w-16 px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-number"
            type="text"
            placeholder="20"
          />
        </div>
      </div>

      <div className="flex flex-wrap mb-2 -mx-3">
        <div className="w-full px-3 mb-6 md:w-1/3 md:mb-0">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-city"
          >
            City
          </label>
          <input
            className="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-city"
            type="text"
            placeholder="Uelzen"
          />
        </div>
        <div className="w-full px-3 mb-6 md:w-1/3 md:mb-0">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-state"
          >
            State
          </label>
          <div className="relative">
            <input
              className="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
              id="grid-state"
              type="text"
              placeholder="Germany"
            />
          </div>
        </div>
        <div className="w-full px-3 mb-6 md:w-1/3 md:mb-0">
          <label
            className="block mb-2 text-xs font-bold tracking-wide text-white uppercase"
            htmlFor="grid-zip"
          >
            Zip
          </label>
          <input
            className="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-zip"
            type="text"
            placeholder="29525"
          />
        </div>
      </div>
      <button
        className="block w-2/5 px-4 py-3 mx-auto my-4 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700"
        id="createEvent-button"
        onClick={() => {
          const name = document.getElementById("grid-event").value;
          const description = document.getElementById("grid-description").value;
          const street = document.getElementById("grid-street").value;
          const number = document.getElementById("grid-number").value;
          const city = document.getElementById("grid-city").value;
          const state = document.getElementById("grid-state").value;
          const zip = document.getElementById("grid-zip").value;
          props.setEvent(name, description, street, number, city, state, zip);
        }}
      >
        Add Event
      </button>
    </div>
  );
}
