
<?php
/**
 * @package Ancient Chinese poetry-Backstage
 * @version 1.0.3
 */
/*
/**
 * By Andy17269
 */
Plugin Name: Ancient Chinese poetry-Backstage
Plugin URI: https://wenlei.club
Description: 在您的Wordpress后台显示一句古诗词，让您感受到中国古诗的魅力！
Author: 干净T松鼠
Version: 1.0.3
Author URI: https://wenlei.club/
*/

function wen_gs_get_lyric() {
	/** gs */
	$lyrics = "云霞咫尺压吴郊，乘兴斯须棹小舠。
山有木兮木有枝，心悦君兮君不知。
竹外桃花三两枝，春江水暖鸭先知。
海上生明月，天涯共此时。
二十四桥明月夜，玉人何处教吹箫？
世间无限丹青手，一片伤心画不成。
黄沙百战穿金甲，不破楼兰终不还。
男儿何不带吴钩，收取关山五十州。
落红不是无情物，化作春泥更护花。
风萧萧兮易水寒，壮士一去兮不复还。
呜呼！楚虽三户能亡秦，岂有堂堂中国空无人！
苟利国家生死以，岂因祸福避趋之！
夜阑卧听风吹雨，铁马冰河入梦来。
商女不知亡国恨，隔江犹唱后庭花。
人生自古谁无死？留取丹心照汗青。
春宵一刻值千金，花有清香月有阴。
位卑未敢忘忧国，事定犹须待阖棺。
纸上得来终觉浅，绝知此事要躬行。
春色满园关不住，一枝红杏出墙来。
竹外桃花三两枝，春江水暖鸭先知。
枝上柳绵吹又少，天涯何处无芳草。
欲把西湖比西子，淡妆浓抹总相宜。
日啖荔枝三百颗，不辞长作岭南人。
春宵一刻值千金，花有清香月有阴。
臣心一片磁针石，不指南方不肯休。
人生自古谁无死，留取丹心照汗青。
衣带渐宽终不悔，为伊消得人憔悴。
在天愿作比翼鸟，在地愿为连理枝。
天长地久有时尽，此恨绵绵无绝期。
日出江花红胜火，春来江水绿如蓝。
春风得意马蹄疾，一日看尽长安花。
心事浩茫连广宇，于无声处听惊雷。
横眉冷对千夫指，俯首甘为孺子牛。
梦里依稀慈母泪，城头变幻大王旗。
忍看朋辈成新鬼，怒向刀丛觅小诗。
吟罢低眉无写处，月光如水照缁衣。
寄意寒星荃不察，我以我血荐轩辕。
雄关漫道真如铁，而今迈步从头越。
不患贫而患不均，不患寡而患不安。
心病还须心药治，解铃还须系铃人。";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function wen_gs() {
	$chosen = wen_gs_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="gs"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( ' ' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'wen_gs' );

// We need some CSS to position the paragraph.
function gs_css() {
	echo "
	<style type='text/css'>
	#gs {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #gs {
		float: left;
	}
	.block-editor-page #gs {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#gs,
		.rtl #gs {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'gs_css' );
