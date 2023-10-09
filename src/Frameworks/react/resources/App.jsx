import { useState } from 'react'
import reactLogo from '@/react.svg'

function App() {
	const [count, setCount] = useState(0)
  	return (
    	<div className="App">
			<div className="logos">
				<img src="https://github.com/dimtrovich/blitzphp-vite/raw/master/src/logo.png" className="logo" alt="Codeigniter vite logo" />
				<img src={reactLogo} className="logo" alt="React logo" />
			</div>
			<h2>BlitzPHP Vite + React</h2>
			<p>
				<button onClick={() => setCount((count) => count + 1)}>
					count is {count}
				</button>
			</p>
      		<p>Edit resources/App.jsx and save to test HMR</p>
    	</div>
  	)
}

export default App