import React, {Component} from 'react';

export default class Admin extends Component {
  render() {

    const { admin } = this.props;
    let infix = admin.middlename ? admin.middlename : '';
    let fullName = `${admin.firstname} ${infix} ${admin.lastname}`;
    let emailLink = 'mailto:' + admin.email;
    let phone = admin.phone ? admin.phone : '';
    let gsm = admin.gsm ? admin.gsm : '';

    return (
        <tr>
          <td id='Admin'>
            { fullName }<br />
            <a href={ emailLink }>{ admin.email }</a>
            </td>
          <td>
            { phone } <br />
            { gsm }
          </td>
        </tr>
    )
  }
}
