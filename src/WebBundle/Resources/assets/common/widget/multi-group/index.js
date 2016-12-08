import React, { Component } from 'react';
import List from './list';
import InputGroup from './input-group';
import './style.less'

class MultiGroup extends Component {
  constructor(props) {
    super(props);
    this.state = {
      items: this.props.items,
      key: this.props.fieldName + '-' + (Math.random() + "").substr(2)
    }
  }

  componentDidMount(){
    if(!this.props.sortable){
      return;
    }
    let self = this;
    $(document).bind('items-sorted', function(event, key, sortedItems){
      if(self.state.key !== key){
        return;
      }
      self.setState({
        items: sortedItems
      });
    });
  }

  removeItem(index) {
    this.state.items.splice(index,1);
    this.setState({
      items: this.state.items
    });
  }

  addItem(item) {
    this.state.items.push(item);
    this.setState({
      items: this.state.items
    });
  }

  render (){
    console.log('render parent');
    return (
      <div className="multi-group">
        <List removeItem={(index)=>this.removeItem(index)} compKey={this.state.key} sortable={this.props.sortable} list={this.state.items}  />
        <InputGroup addItem={(item)=>this.addItem(item)} search = {false}/>
        <input type='hidden' id={this.state.key} name={this.props.fieldName} value={JSON.stringify(this.state.items)} />
      </div>
    );
  }
}

export default MultiGroup;