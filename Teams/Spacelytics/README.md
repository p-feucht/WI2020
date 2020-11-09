<p align="center">
  <img width="250" height="250" src="./public/logo.png">
</p>

# Introduction 🚀
 
Spacelytics uses ADS-B data  to show air-traffic 🛫 on a map 🗺

## Getting Started 🎉

### Development 💻
**❗ Important ❗**: All video assets are stored on [git large file storage ](https://git-lfs.github.com). This is advantageous because it allows downloading these assets only if they are truly needed. However, it requires everyone who wants to download them to have [git large file storage ](https://git-lfs.github.com)installed. If that is the case a *git clone* works as expected. 
For more information refer to: https://www.atlassian.com/git/tutorials/git-lfs#clone-respository
````bash
# Clone the repo and cd into the right directory 
git clone https://github.com/p-feucht/WI2020.git
cd WI2020/Teams/spacelytics
# Install all dependencies 
yarn 
# Start the development server 
yarn dev 
````

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

**❗ Note❗:** If you use Safari, the geolocate button won`t work because the development server by default only supports http connections 
The following article describes how to setup a https connection to localhost: [NextJS + HTTPS | For a Local Dev Server](https://medium.com/responsetap-engineering/nextjs-https-for-a-local-dev-server-98bb441eabd7)

## Tech Stack 🤓

- [Next.js](https://nextjs.org)
- [React](https://reactjs.org)
- [Tailwindcss](https://tailwindcss.com)
- [Mapbox GL JS](https://docs.mapbox.com/mapbox-gl-js/api/) (with a [react wrapper](https://visgl.github.io/react-map-gl/) made by Uber)

### Authors 🎉

- Nils Krause
- Felix Behne
