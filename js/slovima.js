function izBrojaUSlova(n, rod, padez) {
        var b = ['nula', [['jedan', 'jednog', 'jednom', 'jedan',
			'jedan', 'jednim', 'jednom'],
			['jedna', 'jedne', 'jednoj', 'jednu', 'jedna', 'jednom', 'jednoj']],
			['dva', 'dve'],
			'tri', 'cetiri', 'pet', 'sest', 'sedam', 'osam',
			'devet', 'deset', 'jedanaest', 'dvanaest', 'trinaest', 'cetrnaest',
			'petnaest', 'sestnaest', 'sedamnaest', 'osamnaest', 'devetnaest'
		];
		var d = ['dvadeset', 'trideset', 'cetrdeset', 'pedeset',
			'sezdeset', 'sedamdeset', 'osamdeset', 'devedeset'];
		var s = ['sto', 'dvesta', 'trista', 'cetiristo', 'petsto',
			'sesto',  'sedamsto',  'osamsto',  'devetsto'];
		var h = ['hiljadu', 'dvehiljade', 'trihiljade', 'cetirihiljade', 'pethiljada', 'sesthiljada', 'sedamhiljada',
			'osamhiljada', 'devethiljada'];
		var pom = ['jedna', 'dve', 'tri', 'cetiri', 'pet', 'sest', 'sedam', 'osam', 'devet'];
		var dh = ['desethiljada', 'jedanaesthiljada', 'dvanaesthiljada', 'trinaesthiljada', 'cetrnaesthiljada', 'petnaesthiljada', 'sesnaesthiljada', 'sedamnaesthiljada', 'osamnaesthiljada', 'devetnaesthiljada', 'dvadesethiljada'];
		for(var i = 0; i < d.length; i++) {
			for(var j = 0; j < pom.length; j++) {
				dh.push(d[i] + pom[j]);
			}
			dh.push(d[i] + 'hiljada');
		}
		var sh = [];
		if(n == 0)
			return 0;
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
        } else if (n < 10000) {
			return h[Math.floor(n / 1000) - 1] + '' + izBrojaUSlova(n % 1000, rod, padez);
		} else if (n < 100000) {
			return dh[Math.floor(n / 10000) - 1] + '' + izBrojaUSlova(n % 10000, rod, padez);
		}
		else {
            return "error";
        }
}