function izBrojaUSlova(n, rod, padez) {
        var b = ['nula', [['jedan', 'jednog', 'jednom', 'jedan',
			'jedan', 'jednim', 'jednom'],
			['jedna', 'jedne', 'jednoj', 'jednu', 'jedna', 'jednom', 'jednoj']],
			['dva', 'dve'],
			'tri', 'četiri', 'pet', 'šest', 'sedam', 'osam',
			'devet', 'deset', 'jedanaest', 'dvanaest', 'trinaest', 'četrnaest',
			'petnaest', 'šestnaest', 'sedamnaest', 'osamnaest', 'devetnaest'
		];
		var d = ['dvadeset', 'trideset', 'četrdeset', 'pedeset',
			'šezdeset', 'sedamdeset', 'osahmdesetmdeset', 'devedeset'];
		var s = ['sto', 'dvesta', 'trista', 'četiristo', 'petsto',
			'šesto',  'sedamsto',  'osamsto',  'devetsto'];
			
		function rec_hiljada(n) {
			if (n == 1)
				return "hiljadu";
			var pc = n % 10;
			if (pc == 2 || pc == 3 || pc == 4)
				return "hiljade";
			else
				return "hiljada";
		}
		
		var sh = [];
		/*
			if(n == 0)
				return 0;
			
			je bilo ja sam stavio da return "";
		*/
		if(n == 0)
			return "";
        if (n == 1)
            return b[1][rod-1][padez-1];
        else if (n == 2)
            return b[2][rod-1];
        else if (n < 20)
            return b[n];
        else if (n < 100)
            return d[Math.floor(n / 10) - 2] + ((n % 10 != 0) ? 'i' + izBrojaUSlova(n % 10, rod, padez) : '');
        else if (n < 1000) {
            return s[Math.floor(n / 100) - 1] + '' + izBrojaUSlova(n % 100, rod, padez);
        } else if (n < 1000000){
			broj_hiljada = Math.floor(n / 1000);
			return (broj_hiljada > 1 ? izBrojaUSlova(broj_hiljada, rod, padez) : "") + rec_hiljada(broj_hiljada) + (n % 1000 > 0 ? izBrojaUSlova(n % 1000, rod, padez) : "");
		}
		else {
            return "error";
        }
}