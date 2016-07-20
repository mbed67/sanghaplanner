import React, {Component} from 'react';
import Conditional from 'react-conditional-component';
import Member from './Member';
import Notification from './Notification';

export default class Members extends Component {
  render() {
      const {
          approveMembershipRequest,
          rejectMembershipRequest,
          isAdminOfThisSangha,
          isMemberOfThisSangha,
          members,
          notifications,
          route
          } = this.props;

      let memberComponents = [];

      if(members.length > 0) {
          members.forEach(function(member) {
              let cell = <tr>
                  <td className="col-md-2"> {member.firstname} {member.middlename} {member.lastname} </td>
                  <td className="col-md-2"> {member.address} <br /> {member.zipcode} {member.place} </td>
                  <td className="col-md-2"> {member.phone} <br /> {member.gsm} </td>
                  <td className="col-md-2"> {member.email} </td>
                  <td className="col-md-1"> {member.rolename} </td>
              </tr>;

              memberComponents.push(cell)
          });
      } else {
          memberComponents.push(<tr><td colSpan="5">Deze sangha heeft geen leden</td></tr>);
      }

      let notificationComponents = [];

      notifications.forEach(function(notification){
          notificationComponents.push(<Notification key={ notification.id }
                                                    notification = { notification }
                                                    approveMembershipRequest = { approveMembershipRequest }
                                                    rejectMembershipRequest = { rejectMembershipRequest }/>)
      });

      return (
          <div role="tabpanel" className="tab-pane" id="sanghaleden">
              <div className="row">
                  <div className="col-md-9">
                      <Conditional value={ isMemberOfThisSangha }>
                          <div showIfTrue>
                              <div className="panel panel-default">
                                  <div className="panel-heading">Leden van deze sangha</div>
                                  <table className="table">
                                      <tr><th>Naam</th><th>Adres</th><th>Telefoon</th><th>Email</th><th>Rol</th></tr>
                                          { memberComponents }
                                  </table>
                              </div>
                          </div>
                          <div showIfTrue>
                              <a href={ route } className="btn btn-primary">Verlaat sangha</a>
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
      )
  }
}


