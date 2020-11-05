import NavbarItem from './NavbarItem';

const Navbar = () => {
  return (
    <header className='box-border absolute top-0 z-10 flex flex-row items-center w-full bg-transparent'>
      <a className='' href='#'>
        <svg
          width='60'
          xmlns='http://www.w3.org/2000/svg'
          viewBox='0 0 24 24'
          stroke='currentColor'
          fill='white'
        >
          <path
            strokeLinecap='round'
            strokeLinejoin='round'
            strokeWidth={2}
            d='M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
          />
        </svg>
      </a>
      <span className='text-2xl italic font-semibold text-gray-500 '>
        BehneFinn
      </span>

      <nav>
        <ul className='flex space-x-24 '>
          <NavbarItem text='Map' />
          <NavbarItem text='Documentation' />
          <NavbarItem text='About' />
        </ul>
      </nav>
    </header>
  );
};
export default Navbar;
