import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import { render } from 'react-dom';
import { connect } from 'react-redux';
import Sangha from './../components/Sangha';
import CreateRetreat from './../components/modals/CreateRetreat'
import * as sanghaActions from '../actions/sangha';
import * as modalTypes from '../constants/ModalTypes';

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
            sanghaId
        );
    }

    removeMember(userId, sanghaId) {
        this.actions.removeMember(
            userId,
            sanghaId
        );
    }

    showCreateRetreatModal(sanghaId) {
        this.actions.showCreateRetreatModal(modalTypes.CREATE_RETREAT, sanghaId);
    }

    createRetreatForSangha(sanghaId) {
        this.actions.createRetreatForSangha(sanghaId);
    }

    hideCreateRetreatModal() {
        this.actions.hideModal(modalTypes.CREATE_RETREAT);
    }

    render() {
      return (
        <div id='App'>
          <Sangha approveMembershipRequest={ this.approveMembershipRequest.bind(this) }
                  rejectMembershipRequest={ this.rejectMembershipRequest.bind(this) }
                  toggleRole={ this.toggleRole.bind(this) }
                  removeMember={ this.removeMember.bind(this) }
                  showCreateRetreatModal={ this.showCreateRetreatModal.bind(this) }
                  {...this.props}/>
          <CreateRetreat show={ this.props.modals.CreateRetreat.show }
                         bsSize={ this.props.modals.CreateRetreat.bsSize }
                         createRetreatForSangha = { this.createRetreatForSangha.bind(this) }
                         onHide={ this.hideCreateRetreatModal.bind(this) }/>
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
        retreats: state.retreats.retreats,
        routes: state.routes,
        modals: state.modals
    }
};

// Connect connects react and redux together.
export default connect(mapStateToProps)(App);
