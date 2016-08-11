import React, {Component} from 'react';
import Conditional from 'react-conditional-component';

export default class Retreats extends Component {
  render() {

      const {
          isAdminOfThisSangha,
          isMemberOfThisSangha,
          retreats,
          routes
          } = this.props;

      let retreatComponents = [];

      if(retreats.length > 0) {
          retreats.forEach(function(retreat) {
              let cell = <tr key={ retreat.id }>
                  <td className="col-md-4"> { retreat.description } </td>
                  <td className="col-md-4"> { retreat.retreat_start } </td>
                  <td className="col-md-4"> { retreat.retreat_end }</td>
                  </tr>

                  retreatComponents.push(cell)
           })
      } else {
          retreatComponents.push(<tr><td colSpan="3">Deze sangha heeft geen evenementen</td></tr>);
      }

    return (
      <div role="tabpanel" className="tab-pane" id='evenementen'>
          <div className="row">
              <div className="col-md-9">
                  <Conditional value={ isMemberOfThisSangha }>
                      <div showIfTrue>
                          <div className="panel panel-default">
                              <table className="table">
                                  <tbody>
                                      <tr><th>Evenement</th><th>Begin</th><th>Eind</th></tr>
                                      { retreatComponents }
                                  </tbody>
                              </table>
                          </div>
                          <Conditional value={ isAdminOfThisSangha }>
                              <div showIfTrue className="form-group">
                                  <a href={ routes.createRetreat } className="btn btn-primary">Nieuw evenement</a>
                              </div>
                          </Conditional>
                      </div>
                      <div showIfFalse className="alert alert-warning">
                          U moet lid zijn om deze pagina te kunnen bekijken
                      </div>
                  </Conditional>
              </div>
          </div>
      </div>
    )
  }
}


