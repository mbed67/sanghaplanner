import React, {Component} from 'react';
import Admin from './Admin';
import Conditional from 'react-conditional-component'


export default class General extends Component {
  render() {
    const { isAdminOfThisSangha, sangha, admins } = this.props;

    const sanghaname = sangha.sanghaname.replace(/ /g, "_");
    const pathToImage = "/images/" + sanghaname + "/" + sangha.filename;

    let adminComponents = [];

    admins.forEach(function(admin) {
      adminComponents.push(<Admin key={ admin.id } admin={ admin }/>)
    });

    if (adminComponents.length === 0) {
      adminComponents = <tr><td>Contactpersonen</td><td>Deze sangha heeft geen contactpersonen</td></tr>;
    }

    return (
        <div role="tabpanel" className="tab-pane active" id="algemeen">
          <div className="row">
            <div className="col-md-9">
              <div className="panel panel-default">
                <div className="panel-heading">Contactgegevens</div>

                <table className="table">
                  <tbody>
                    <tr>
                      <td>Adres</td>
                      <td>
                        { sangha.address }<br />
                        { sangha.zipcode }  { sangha.place }
                      </td>
                    </tr>
                    { adminComponents }
                  </tbody>
                </table>
              </div>
              <Conditional value={ isAdminOfThisSangha }>
                <div className="form-group" showIfTrue>
                  <a href=""
                </div>
              </Conditional>
            </div>
            <div className="col-md-3">
              <Conditional value={ sangha.filename }>
                <div className="media">
                  <img showIfDefined className="media-object" src={ pathToImage } alt={ sangha.sanghaname } />
                </div>
              </Conditional>
            </div>
          </div>
        </div>
    )
  }
}

