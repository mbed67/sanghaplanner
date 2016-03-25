import React, {Component} from 'react';
import Conditional from 'react-conditional-component';
import Member from './Member';
import Notification from './Notification';

export default class Members extends Component {
  render() {
      const { isAdminOfThisSangha, isMemberOfThisSangha, sangha, notifications } = this.props;

      let memberComponents = [];

      sangha.users.forEach(function(member) {
          memberComponents.push(<Member key={ member.id } member={ member }/>)
      });

      let notificationComponents = [];

      notifications.forEach(function(notification){
          notificationComponents.push(<Notification key={ notification.id } notification = { notification }/>)
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
                              <h4>Lidmaatschapsverzoeken</h4>
                              <Conditional value={ notificationComponents.length }>
                                  <div showIfGte={ 1 }>
                                      { notificationComponents }
                                  </div>
                              </Conditional>
                          </div>
                      </Conditional>
                  </div>
              </div>
          </div>
      </div>
    )
  }
}


