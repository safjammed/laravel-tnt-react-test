import React from 'react';

import './search-bar.styles.scss';

const SearchBar = ({placeholder, handleClick}) => {
    return (
        <div className="search-box">
            <input
                type="search"
                placeholder={placeholder || "Type Keywords"}
                className={'search form-control'}
            />
            <button onClick={handleClick} className="btn btn-success">Search</button>
        </div> );
};

export default SearchBar;
