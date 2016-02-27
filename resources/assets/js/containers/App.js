import React, { Component } from 'react';
import { render } from 'react-dom';
import { connect } from 'react-redux';
import Sangha from './../components/Sangha';

class App extends Component {
    render() {
      return (
        <div id='App'>
          <Sangha { ...this.props}/>
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
