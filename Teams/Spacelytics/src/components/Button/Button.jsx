import React from 'react';
import classNames from 'classnames/bind';
import styles from './Button.module.css';
import PropTypes from 'prop-types';

let cx = classNames.bind(styles);

const Button = ({
  disabled,
  primary,
  backgroundColor,
  size,
  label,
  ...props
}) => {
  const mode = primary ? 'primary' : 'secondary';
  const status = disabled ? 'inactive' : '';
  const classNames = cx('btn', {
    [`btn--${mode}`]: true,
    [`btn--${status}`]: true,
    [`btn--${size}`]: true,
  });
  return (
    <button
      type='button'
      className={classNames}
      disabled={disabled}
      style={backgroundColor && { backgroundColor }}
      {...props}
    >
      {label}
    </button>
  );
};

export default Button;

Button.propTypes = {
  /**
   * Is this the principal call to action?
   */
  primary: PropTypes.bool,
  /**
   * Is the button active ?
   */
  disabled: PropTypes.bool,
  /**
   * What backgroundColor do you want to use?
   */
  backgroundColor: PropTypes.string,
  /**
   * How large should the button be?
   */
  size: PropTypes.oneOf(['small', 'default', 'large']),
  /**
   * Button text
   */
  label: PropTypes.string.isRequired,
  /**
   * Optional click handler
   */
  onClick: PropTypes.func,
};

Button.defaultProps = {
  backgroundColor: null,
  primary: false,
  size: 'default',
  onClick: undefined,
};
