import React from 'react';
import './App.css';
import SearchBar from "./components/search-bar/search-bar.component";


class App extends React.Component{
    constructor(){
        super();
        this.state = {
            monsters: [],
            searchField: ''
        }
    }
    handleClick = (e)=>{
        this.setState({searchField: e.target.value})
    };
    render() {
        return (
            <div className="App">
                <div className="App">
                    <h1>Monster Rolodex</h1>
                    <SearchBar
                        placeholder={"TNT search test"}
                        handleClick={this.handleClick}
                    />
                </div>

            </div>

        );
    }
}
export default App;

