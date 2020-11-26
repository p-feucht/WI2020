<p align="center">
  <img width="250" height="250" src="./public/logo.png">
</p>

# Introduction 🚀
 
Spacelytics uses ADS-B data  to show air-traffic 🛫 on a map 🗺

[Go to deployed version](https://spacelytics-prod.vercel.app)🎉

## Getting Started 🎉

### Development 💻
**❗ Important ❗**: LogIn and LogOut doesn´t work in dev mode(callback that is defined in the oauth application settings on github links to prod url)
````bash
# Clone the repo and cd into the right directory 
git clone https://github.com/p-feucht/WI2020.git
cd WI2020/Teams/spacelytics
# Install all dependencies 
yarn 
# Start the development server 
yarn dev 

# Start component library (Storybook)
yarn storybook 
````



Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

**❗ Note❗:** If you use Safari, the geolocate button won`t work because the development server by default only supports HTTP connections 
The following article describes how to set up an HTTPS connection to localhost: [NextJS + HTTPS | For a Local Dev Server](https://medium.com/responsetap-engineering/nextjs-https-for-a-local-dev-server-98bb441eabd7)

## Tech Stack 🤓

- [Next.js](https://nextjs.org)
- [Next-auth](https://next-auth.js.org)
- [Prisma](https://www.prisma.io)
- [Postgres](https://www.postgresql.org)
- [React](https://reactjs.org)
- [CSS-modules](https://github.com/css-modules/css-moduleshttps://github.com/css-modules/css-modules)
- [Storybook](https://storybook.js.org)
- [Mapbox GL JS](https://docs.mapbox.com/mapbox-gl-js/api/) (with a [react wrapper](https://visgl.github.io/react-map-gl/) made by Uber)

### Authors 🎉

- Nils Krause
- Felix Behne
