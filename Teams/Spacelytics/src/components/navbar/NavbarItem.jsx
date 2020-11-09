function NavbarItem(props) {
  return (
    <li>
      <a
        className=' text-white border border-transparent rounded-full py-2 px-4 hover:border-white'
        href='#'
      >
        {props.text}
      </a>
    </li>
  );
}

export default NavbarItem;
