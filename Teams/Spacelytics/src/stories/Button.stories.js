import React from 'react';
import Button from './../components/Button';

export default {
  title: 'Spacelytics/Button',
  component: Button,
  argTypes: {
    backgroundColor: { control: 'color' },
    onClick: { action: 'clicked' },
  },
};

const Template = (args) => <Button {...args} />;

export const Primary = Template.bind({});
Primary.args = {
  primary: true,
  label: 'Das ist ein Button',
};
export const Secondary = Template.bind({});
Secondary.args = {
  primary: false,
  label: 'Das ist ein Button',
};
export const Disabled = Template.bind({});
Disabled.args = {
  primary: true,
  disabled: true,
  label: 'Das ist ein Button',
};
export const Small = Template.bind({});
Small.args = {
  primary: true,
  size: 'small',
  label: 'Das ist ein Button',
};
export const Default = Template.bind({});
Default.args = {
  primary: true,
  size: 'default',
  label: 'Das ist ein Button',
};
export const Large = Template.bind({});
Large.args = {
  primary: true,
  size: 'large',
  label: 'Das ist ein Button',
  onClick: () => console.log('Clicked'),
};
