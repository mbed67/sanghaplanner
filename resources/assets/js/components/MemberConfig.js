import React, {Component} from 'react';
import Conditional from 'react-conditional-component';

export default class MemberConfig extends Component {
    constructor(props) {
        super(props);

        this.toggleRole = this.toggleRole.bind(this);
    }

    toggleRole() {
        this.props.toggleRole(this.props.userId, this.props.sanghaId);
    }

    render() {

      let toggleRoleText = this.props.role === 'administrator' ? "Maak lid" : "Maak admin";

      return(
        <div className="dropdown open">
          <a className="fa fa-cog dropdown-toggle"
             type="button"
             id="MemberConfig"
             data-toggle="dropdown"
             aria-haspopup="true"
             aria-expanded="false">
          </a>
          <div className="dropdown-menu" aria-labelledby="MemberConfig">
            <li><a onClick={ this.toggleRole }>{ toggleRoleText }</a></li>
            <li><a href="#">Verwijder</a></li>
          </div>
        </div>
    );
  }
}
