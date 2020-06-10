import React from 'react';
import ReactDOM from 'react-dom';

class Anagram extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
          error: null,
          isLoaded: false,
          items: [],
          value: ''
        };
        this.handleChange = this.handleChange.bind(this)
      }

    componentDidMount() {
        fetch(`http://127.0.0.1:8000/api/anagram/${this.value}`)
          .then(res => res.json())
          .then(
            (result) => {
              this.setState({
                isLoaded: true,
                items: result
              });
            },
            (error) => {
              this.setState({
                isLoaded: true,
                error
              });
            }
          )
      }

    handleChange(e){
        const endpoint = `http://127.0.0.1:8000/api/anagram/${e.target.value}`;
        fetch(endpoint).then(res => res.json()).then((result) => {
                this.setState({
                    isLoaded: true,
                    items: result
                });
              },
              (error) => {
                this.setState({
                  isLoaded: true,
                  error
                });
              }
            )
    }

      render(){
        const {isLoaded, items } = this.state;
        if (!isLoaded) {
          return <div>Loading...</div>;
        } else {
          return (
            <div>
                <form>
                    <input type='text' placeholder='Anagram' onChange={this.handleChange}/>
                    <h1>{this.state.api}</h1>
                </form>
                <ul>
                    {items.data.map((anagram, i) => {
                        return (<li key={i} >{anagram.anagram}</li>)
                    })}
                </ul>
            </div>
          );
        }
      }
}
function App() {
    return (
      <div className="App">
        <Anagram />
      </div>
    );
  }
ReactDOM.render(<App />, document.getElementById("anagram"));
export default Anagram;

