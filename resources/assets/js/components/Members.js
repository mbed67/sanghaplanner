import React, {Component} from 'react';

import Member from './Member';

export default class Members extends Component {
  render() {
      const { isAdminOfThisSangha, isMemberOfThisSangha, sangha, notifications } = this.props;

      let memberComponents = [];

      sangha.users.forEach(function(member) {
          memberComponents.push(<Member key={ member.id } member={ member }/>)
      });

      return (
      <div id='Members'>
          <div role="tabpanel" className="tab-pane" id="sanghaleden">
              <div className="row">
                  <div className="col-md-9">
                      <Conditional value={ isMemberOfThisSangha }>
                          <div showIfTrue>
                              { memberComponents }
                          </div>
                          <div>
                              Button om de sangha te verlaten
                          </div>
                          <div showIfFalse className="alert alert-warning">U moet lid zijn om deze pagina te kunnen bekijken</div>
                      </Conditional>
                  </div>
                  <div className="col-md-3">
                      <Conditional value={ isAdminOfThisSangha }>
                          <div showIfTrue>
                              @include('notifications.partials.membershipRequests', ['notifications' => $notifications])
                          </div>
                      </Conditional>
                  </div>
              </div>
          </div>
      </div>
    )
  }
}


