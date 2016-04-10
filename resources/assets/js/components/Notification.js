import React, {Component} from 'react';


export default class Notification extends Component {
    constructor(props) {
        super(props);

        this.approve = this.approve.bind(this);
        this.reject = this.reject.bind(this);
      }

    approve() {
        this.props.approveMembershipRequest(
            this.props.notification.id,
            this.props.notification.senderId,
            this.props.notification.sanghaId
        );
      }

    reject() {
        this.props.rejectMembershipRequest(
            this.props.notification.id,
            this.props.notification.senderId,
            this.props.notification.sanghaId
        );
    }

    render() {
    const { key, notification } = this.props;

    return (
        <article className="media status-media">
          <div className="pull-left">
            <a href={ notification.profilePath }>
              <img className="media-object img-circle avatar" src={ notification.avatar } alt={ notification.senderId } />
            </a>

          </div>

          <div className="media-body">
            <h4 className="media-heading">{ notification.firstName } { notification.middleName } { notification.lastName }</h4>
          </div>

          <form ref="form">
            <div className="button-group btn-group-xs">
              <button className="button-submit" type="button" onClick={ this.approve }>Goedkeuren</button>
              <button className="button-submit" type="button" onClick={ this.reject }>Afwijzen</button>
            </div>
          </form>
        </article>
    )
  }
}
