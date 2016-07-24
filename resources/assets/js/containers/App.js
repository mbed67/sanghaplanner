import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import { render } from 'react-dom';
import { connect } from 'react-redux';
import Sangha from './../components/Sangha';
import * as sanghaActions from '../actions/sangha';

class App extends Component {
    constructor(props) {
        super(props);

        this.actions = bindActionCreators(
            Object.assign({}, sanghaActions),
            this.props.dispatch
        );
    }

    approveMembershipRequest(id, userId, sanghaId) {
        this.actions.approveMembershipRequest(
            id,
            userId,
            sanghaId
        );
    }

    rejectMembershipRequest(id, userId, sanghaId) {
        this.actions.rejectMembershipRequest(
            id,
            userId,
            sanghaId
        );
    }

    toggleRole(userId, sanghaId) {
        this.actions.toggleRole(
            userId,
            sanghaId);
    }

    removeMember(userId, sanghaId) {
        this.actions.removeMember(
            userId,
            sanghaId);
    }

    render() {
      return (
        <div id='App'>
          <Sangha approveMembershipRequest={ this.approveMembershipRequest.bind(this) }
                  rejectMembershipRequest={ this.rejectMembershipRequest.bind(this) }
                  toggleRole={ this.toggleRole.bind(this) }
                  removeMember = { this.removeMember.bind(this) }
                  {...this.props}/>
        </div>
      )
    }
}

const mapStateToProps = (state) => {
    return {
        isAdminOfThisSangha: state.security.isAdminOfThisSangha,
        isMemberOfThisSangha: state.security.isMemberOfThisSangha,
        sangha: state.sangha,
        notifications: state.notifications.notifications,
        admins: state.admins,
        members: state.members.members,
        retreats: state.retreats,
        routes: state.routes
    }
};

// Connect connects react and redux together.
export default connect(mapStateToProps)(App);
