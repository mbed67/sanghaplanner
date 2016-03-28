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

    approveMembershipRequest(userId, sanghaId, token) {
        this.actions.approveMembershipRequest(
            userId,
            sanghaId,
            token
        );
    }

    render() {
      return (
        <div id='App'>
          <Sangha approveMembershipRequest={ this.approveMembershipRequest.bind(this) }
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
        notifications: state.notifications,
        admins: state.admins,
        retreats: state.retreats,
        routes: state.routes
    }
};

// Connect connects react and redux together.
export default connect(mapStateToProps)(App);
