import React, { Component } from 'react';

import General from './General';
import Events from './Events';
import Members from './Members';

export default class Sangha extends Component {
  render() {
    const {
        approveMembershipRequest,
        rejectMembershipRequest,
        isAdminOfThisSangha,
        isMemberOfThisSangha,
        sangha,
        notifications,
        admins,
        members,
        retreats,
        routes
        } = this.props;

    return (
      <div id='Sangha'>

          <div className="row">
              <div className="col-md-9">
                  <h1>{ sangha.sanghaname } </h1>
                  <div>
                      <ul className="nav nav-tabs" role="tablist" id="sanghaTab">
                          <li role="presentation" className="active">
                              <a href="#algemeen" aria-controls="algemeen" role="tab" data-toggle="tab">
                                  Algemeen
                              </a>
                          </li>
                          <li role="presentation">
                              <a href="#sanghaleden" aria-controls="sanghaleden" role="tab" data-toggle="tab">
                                  Sanghaleden
                              </a>
                          </li>
                          <li role="presentation">
                              <a href="#evenementen" aria-controls="evenementen" role="tab" data-toggle="tab">
                                  Evenementen
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <div className="tab-content">
              <General isAdminOfThisSangha = { isAdminOfThisSangha }
                       sangha = { sangha }
                       admins = { admins }
                       route = { routes.editSanghaRoute }
              />
              <Members approveMembershipRequest = { approveMembershipRequest }
                       rejectMembershipRequest = { rejectMembershipRequest }
                       isAdminOfThisSangha = { isAdminOfThisSangha }
                       isMemberOfThisSangha = { isMemberOfThisSangha }
                       members = { members }
                       notifications = { notifications }
                       routes = { routes }
              />
              <Events sangha = { sangha } retreats = { retreats } />
          </div>
      </div>
    )
  }
}
